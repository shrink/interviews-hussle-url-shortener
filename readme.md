# Laravel URL Shortener

A simple URL shortener. A user provides a location, we generate a unique key and
provide a URL containing the key which redirects to the location. A user can
view statistics covering the usage of their short URL.

## Environment

- [x] SQLite datastore

## Models

### Link

- [ ] `id` integer
- [ ] `key` string
- [ ] `location` string
- [ ] `created_at` timestamp
- [ ] `updated_at` timestamp

### Visits

- [ ] `link_id` integer, foreign key on Link
- [ ] `visitor_hash` string
- [ ] `created_at` timestamp
- [ ] `updated_at` timestamp

## Functionality

- [ ] A user should be able to shorten a URL
- [ ] A shortened URL should redirect to the target URL
- [ ] A user should be able to see service statistics
- [ ] A user should be able to see a shortened URL's visit statistics
- [ ] Visit statistics should be tested for uniqueness based on IP address (without storing IP addresses)

## Statistics

- [ ] Unique visits (all links, a link) [last 24 hours, all time]
- [ ] Total links created (last 24 hours, all time)
- [ ] Total visits (last 24 hours, all time)
- [ ] Total unique visits (last 24 hours, all time)

# Endpoints

### Homepage

```
GET /
```

- [ ] Display global statistics about the service
- [ ] Display a form that accepts a URL to shorten

### Shorten URL Endpoint

```
POST /
```

- [ ] Validate the URL
- [ ] Generate a unique short key
- [ ] Redirect to meta page for shortened URL

### Shortened URL meta page

```
GET /~{key}
```

- [ ] Display the shortened URL
- [ ] Display click statistics

### Shortened URL

```
GET /{key}
```

- [ ] Create a visit with one-way hash of the visitors IP address
  - [ ] One-way hash should be unique to a single URL
- [ ] Redirect to the shortened URL using a 302
