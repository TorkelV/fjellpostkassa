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

(extend-protocol sql/IResultSetReadColumn
  org.postgresql.jdbc4.Jdbc4Array
  (result-set-read-column [pgobj metadata i]
    (vec (.getArray pgobj))))


(defn app []
  (routes
    (GET "/ads/" []
      {:status  200
       :headers {"Content-Type" "application/json"}
       :body    (json/write-str '[234])})))


(defn create-server []
  (server/run-server (app) {:port 8080}))