# Laravel URL Shortener

A simple URL shortener. A user provides a location, we generate a unique key and
provide a URL containing the key which redirects to the location. A user can
view statistics covering the usage of their short URL.

## Usage

Requires PHP 7.3. Download project (as a zip, or via `git clone`) then run:

```
$ composer launch
```

This process will install all dependencies, migrate the database, compile assets
and launch the Laravel development server. Visit
[127.0.0.1:8000](http://127.0.0.1:8000/) once launched.

### Tests

There is a test suite covering (some) core functionality.

```
$ vendor/bin/phpunit
```

## Environment

- [x] SQLite datastore

## Models

### Link

- [x] `id` integer
- [x] `key` string
- [x] `location` string
- [x] `created_at` timestamp
- [x] `updated_at` timestamp

### Visits

- [x] `link_id` integer, foreign key on Link
- [x] `visitor_hash` string
- [x] `created_at` timestamp
- [x] `updated_at` timestamp

## Functionality

- [x] A user should be able to shorten a URL
- [x] A shortened URL should redirect to the target URL
- [x] A user should be able to see service statistics
- [x] A user should be able to see a shortened URL's visit statistics
- [x] Visit statistics should be tested for uniqueness based on IP address (without storing IP addresses)

## Statistics

- [x] Unique visits (all links, a link)
- [x] Total links created
- [x] Total visits
- [x] Total unique visits

# Endpoints

### Homepage

```
GET /
```

- [x] Display global statistics about the service
- [x] Display a form that accepts a URL to shorten

### Shorten URL Endpoint

```
POST /
```

- [x] Validate the URL
- [x] Generate a unique short key
- [x] Redirect to meta page for shortened URL

### Shortened URL meta page

```
GET /~{key}
```

- [x] Display the shortened URL
- [x] Display click statistics

### Shortened URL

```
GET /{key}
```

- [x] Create a visit with one-way hash of the visitors IP address
  - [x] One-way hash should be unique to a single URL
- [x] Redirect to the shortened URL using a 302
