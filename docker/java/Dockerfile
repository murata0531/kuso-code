FROM openjdk:15-buster

RUN apt-get update
# インストール
RUN apt-get install libmysql-java

# mysql.jarのインストール場所確認
# ls /usr/share/java/mysql.jar

# クラスパスの設定を.bashrcに追加
RUN export CLASSPATH=$CLASSPATH:/usr/share/java/mysql.jar

WORKDIR /usr/src