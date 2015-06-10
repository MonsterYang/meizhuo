# Assassinpxdxt
#
# VERSION       2.2

# use the ubuntu base image provided by dotCloud
FROM meizhuo

MAINTAINER Victor Coisne victor.coisne@dotcloud.com

# make sure the package repository is up to date
RUN echo "deb http://archive.ubuntu.com/ubuntu precise main universe" > /etc/apt/sources.list
RUN apt-get update

# install meizhuo
RUN apt-get install -y meizhuo

# Launch meizhuo when launching the container
ENTRYPOINT ["meizhuo"]

# run memcached as the daemon user
USER yxt

# expose memcached port
EXPOSE 11211