FROM mysql:8.0

ENV MYSQL_DATABASE=test \
  MYSQL_USER=test\
  MYSQL_PASSWORD=test \
  MYSQL_ROOT_PASSWORD=test \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/mysql/conf.d/my.cnf
RUN chmod 644 /etc/mysql/conf.d/my.cnf