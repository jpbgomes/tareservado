[Project Data - ChatGPT Conversation](project.pdf)

```
sudo -u postgres psql
```

```
CREATE DATABASE tareservado OWNER dev;
CREATE USER dev WITH PASSWORD 'dev';
GRANT ALL PRIVILEGES ON DATABASE tareservado TO dev;
ALTER DATABASE tareservado OWNER TO dev;
```