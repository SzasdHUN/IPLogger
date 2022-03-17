# __IP Logger by Szasd__
### Version v1.0.0
<br>

The logger is based on [Jacckii's](https://github.com/Jacckii/-PHP-Simple-IP-Logger) code.

Data that the logger can get:
* ip
* date
* country of the ip
* timezone
* utc timezone
* browser
* operating system

The data is stored in a __JSON file__ like this:
```json
    {
        "data": [
            {
                "ip": "192.168.1.1",
                "ymd": "2222.22.22",
                "hms": "15:15:15",
                "timeZone": "Europe/Berlin",
                "country": "DE",
                "utc": "UTC+1",
                "os": "Windows 10",
                "browser": "Edge"
            }
        ]
    }
```
The list uses fetch to get the data.
