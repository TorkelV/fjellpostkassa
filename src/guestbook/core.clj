(ns guestbook.core
  (:require [org.httpkit.server :as server]
            [org.httpkit.client :as http]
            [hickory.core :as hick]
            [hickory.select :as s]
            [compojure.core :refer [routes POST GET ANY]]
            [clojure.data.json :as json]
            [clojure.java.jdbc :as sql]
            [clojure.string :as cstr]))


;;examples
;;(sql/query db ["select * from ad where id not in (select adkey as id from keywords)"])
;;(sql/insert! db :ad (assoc '{} :id (:id ad)
;;                               :jobtype (:jobtype ad)
;;                              :description (:description ad)
;;                               :title (:title ad)
;;                               :url (finn-ad-url (:id ad) (:jobtype ad))
;;                               ))


(def db "postgresql://localhost:5432/guestbook?user=postgres&password=123")


(defn multi-insert-visits [v]
  (sql/insert-multi! db :visits (map #(assoc '{} :m_id (first %)
                                                 :u_id (nth % 1)
                                                 :time (nth % 2)
                                                 :comment (last %)) v)))

(defn add-mountain [tag height name coords]
  (sql/insert! db :mountain (assoc '{}
                              :tag tag
                              :height height
                              :name name
                              :coordinates coords
                              )))

(defn add-user [username password]
  (sql/insert! db :users (assoc '{}
                           :username username
                           :password password
                           )))

(defn add-visit [mountainid userid timestamp comment]
  (sql/insert! db :visits (assoc '{}
                            :m_id mountainid
                            :u_id userid
                            :time timestamp
                            :comment comment
                            )))


(defn total-visits []
  (sql/query db ["SELECT DENSE_RANK() OVER(ORDER BY a.c desc) as rank, \n\t   c as visits, username as name \nFROM (SELECT visits.u_id, count(visits.u_id) as c, users.username from visits \n\t  INNER JOIN users on users.id = visits.u_id::bigint\n\t  GROUP BY visits.u_id, username) a"]))

(defn total-unique-visits []
  (sql/query db ["select rank() over (order by visits desc), visits,username \nfrom(select count(distinct m_id) as visits,u_id,username from visits\n\tinner join users on users.id=u_id::bigint
                  group by u_id,username) a"]))

(defn all-visits-mountain [mountainid]
  (sql/query db ["SELECT RANK() OVER(ORDER BY a.c desc) as rank, \n\t   c as visits, username as name \nFROM (SELECT visits.u_id, count(visits.u_id) as c, users.username from visits \n\t  INNER JOIN users on users.id = visits.u_id::bigint\n\t  where m_id=?::char  GROUP BY visits.u_id, username) a\n" mountainid]))

(defn visits-mountain-for-user [userid mountainid]
  (sql/query db ["select count(u_id) as visits from visits where u_id = ? and m_id = ?" userid mountainid]))

(defn user-rank-visits [userid]
  (sql/query db ["select rank from (SELECT DENSE_RANK() OVER(ORDER BY a.c desc) as rank,
	   c as visits, u_id, username
    FROM (SELECT visits.u_id, count(visits.u_id) as c, users.username from visits
	  INNER JOIN users on users.id = visits.u_id::bigint
	  GROUP BY visits.u_id, username) a) b
	  where u_id = ?" userid]))

(defn user-rank-mountains [userid]
  (sql/query db ["select rank from (SELECT DENSE_RANK() OVER(ORDER BY a.c desc) as rank,\n\t   c as visits, u_id, username\n
              FROM (SELECT visits.u_id, count(distinct visits.m_id) as c, users.username from visits\n\t
              INNER JOIN users on users.id = visits.u_id::bigint\n\t  GROUP BY visits.u_id, username) a) b\n\t
              where u_id = ?" userid]))

(defn get-mountains [userid]
  (sql/query db ["select coalesce(h.uservisits,0) as uservisits, v2.totalVisits as totalvisits, m.m_id as mountainid, u.username as lastVisitor ,v.time as lastVisitTime, m.coordinates as coords, m.height as height, m.name as mountainName from mountain m\nleft join lateral (select time, m_id, u_id from visits where visits.m_id::bigint = m.m_id order by time desc limit 1) v on m.m_id = v.m_id::bigint\ninner join users u on v.u_id::bigint =u.id\ninner join lateral (select m_id, count(visits.m_id) as totalVisits from visits where visits.m_id::bigint = m.m_id group by m_id) v2 on v2.m_id::bigint = m.m_id\nleft join lateral (select m_id, count(u_id) as uservisits from visits where m.m_id = visits.m_id::bigint and u_id= ? group by m_id) h on h.m_id::bigint = m.m_id\n" userid]))

(defn get-guestbook [mountainid]
  (sql/query db ["select\tu.id as userid,\n\t\tu.username as username,\n\t\tv.time as visittime,\n\t\tv.comment as comment\nfrom visits v inner join users u on v.u_id::bigint = u.id\nwhere v.m_id = ? order by visittime desc" mountainid] ))

(defn date-now []
  (str (java.time.LocalDateTime/now)))

(extend-protocol sql/IResultSetReadColumn
  org.postgresql.jdbc4.Jdbc4Array
  (result-set-read-column [pgobj metadata i]
    (vec (.getArray pgobj))))


(defn app []
  (routes
    (GET "/total-visits/" []
      {:status  200
       :headers {"Content-Type" "application/json" "Access-Control-Allow-Origin" "*"}
       :body    (json/write-str (total-visits))})
    (GET "/total-unique-visits/" []
      {:status  200
       :headers {"Content-Type" "application/json" "Access-Control-Allow-Origin" "*"}
       :body    (json/write-str (total-unique-visits))})
    (GET "/all-visits-mountain/:mountainid" [mountainid :as req]
      {:status  200
       :headers {"Content-Type" "application/json" "Access-Control-Allow-Origin" "*"}
       :body    (json/write-str (all-visits-mountain mountainid))})
    (GET "/user-rank-mountains/:userid" [userid :as req]
      {:status  200
       :headers {"Content-Type" "application/json" "Access-Control-Allow-Origin" "*"}
       :body    (json/write-str  (user-rank-mountains userid))})
    (GET "/user-rank-visits/:userid" [userid :as req]
      {:status  200
       :headers {"Content-Type" "application/json" "Access-Control-Allow-Origin" "*"}
       :body    (json/write-str  (user-rank-visits userid))})
    (GET "/get-mountains/:userid" [userid :as req]
      {:status  200
       :headers {"Content-Type" "application/json" "Access-Control-Allow-Origin" "*"}
       :body    (json/write-str  (get-mountains userid))})
    (GET "/get-guestbook/:mountainid" [mountainid :as req]
      {:status  200
       :headers {"Content-Type" "application/json" "Access-Control-Allow-Origin" "*"}
       :body    (json/write-str  (get-guestbook mountainid))})
    (GET "/visits-mountain-for-user/:userid/:mountainid" [userid mountainid]
      {:status  200
       :headers {"Content-Type" "application/json" "Access-Control-Allow-Origin" "*"}
       :body    (json/write-str (visits-mountain-for-user userid mountainid))})))


(defn create-server []
  (server/run-server (app) {:port 8080}))