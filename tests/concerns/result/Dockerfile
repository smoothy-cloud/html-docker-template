FROM nginx:1.18-alpine

COPY nginx.conf /etc/nginx/nginx.conf
COPY code-repository/. /usr/share/nginx/html

EXPOSE 80
WORKDIR /usr/share/nginx/html

CMD ["/usr/sbin/nginx", "-c", "/etc/nginx/nginx.conf"]
