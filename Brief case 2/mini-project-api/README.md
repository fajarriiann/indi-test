# Installation

```sh
$ git clone https://github.com/fajarriiann/indi-test.git
$ cd mini-project-api
$ composer install
$ chance .env.example to .env
$ chance setting to database
$ generate key : php artisan key:generate
$ call action to Migrate Database & Seeder : php artisan migrate --seed
$ start server : php artisan serve
```

# REST API

The REST API to the example app is described below.

## Get list Customer

### Request

`GET /api/customer`

## Create Customer

### Request

`POST /api/customer`

    {
        "name": "Angga",
        "domisili": "Jawa Timur",
        "gender": "PRIA"
    }
    
## Edit Customer

`PUT /api/customer/{id}`

    {
        "name": "Angga",
        "domisili": "Jawa Tengah",
        "gender": "PRIA"
    }
    
## Delete Customer

`DELETE /api/customer/{id}`

## Get list Item

### Request

`GET /api/item`

## Create Item

### Request

`POST /api/item`

    {
        "name": "Pensil",
        "category": "ATK",
        "price": 10000
    }
    
## Edit Item

`PUT /api/item/{id}`

    {
        "name": "Pensil",
        "category": "ATK",
        "price": 20000
    }
    
## Delete Item

`DELETE /api/item/{id}`

## Get list Sale

### Request

`GET /api/sale`

## Create Sale

### Request

`POST /api/sale`

    {
        "customer_id": 1,
        "tgl": "2023-11-23",
        "saleItem": [
            {
                "item_id": 3,
                "qty": 4
            }
        ]
    }
    
## Edit Sale

`PUT /api/sale/{id}`

    {
        "customer_id": 1,
        "tgl": "2023-11-23",
        "saleItem": [
            {
                "item_id": 3,
                "qty": 1
            }
        ]
    }
    
## Delete Sale

`DELETE /api/sale/{id}`
