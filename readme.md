#Lily API

####Base URL: api.lily.services/api
####Create UserCustomer
Link: /signupusercustomer

Method: POST
```
name: String
phone: String
picture: String
email: String
date: Date String
shareCode: String
firstRide: String
address: String
token: String
```
#####Response
On Success
```
{
	"result": "success",
	"userdata": {
		"id": 3,
		"name": "Mashnoor",
		"email": "nmmashnoor@gmail.com",
		"phone": "01912339275",
		"picture": "pic",
		"date": null,
		"shareCode": "9999",
		"firstRide": null,
		"token": "0934885"
		"address": "auygyug"
	}
}
```
On User Exists
```
{
	"result": "User already exists",
	"userdata": {
		"id": 3,
		"name": "Mashnoor",
		"phone": "01912339275",
		"picture": "pic",
		"date": null,
		"email": "nmmashnoor@gmail.com",
		"shareCode": "9999",
		"firstRide": null,
		"token": "0934885",
		"address":"uguyg"
	}
}
```

####Create UserRider
Link: /signupuserrider
```
name: String
phone: String
nidNumber: String
email: String
licenseNO: String
registrationNO: String
licensePic: String
registrationPic: String
userPic: String
date: Date String
shareCode: String
firstRide: Int
token: String
freelancer: Int
address: String
```

#####Response
On Success

```
{
	"result": "success",
	"userdata": {
		"name": "Nowfel Mashnoor",
		"phone": "01826",
		"nidNumber": "237864578237348",
		"licenseNO": "932i9u428",
		"registrationNO": "3y84y89",
		"licensePic": "hgfuygw",
		"registrationPic": "778787834",
		"userPic": "7777",
		"date": "27\/12\/1997",
		"email": "nmmashnoor@gmail.com",
		"shareCode": "999333",
		"firstRide": "0",
		"token": "8888899",
		"id": 3,
		"address":"uhuih"
	}
}
```

On User Exists
```
{
	"result": "User already exists",
	"userdata": {
		"id": 3,
		"name": "Nowfel Mashnoor",
		"phone": "01826",
		"nidNumber": "237864578237348",
		"licenseNO": "932i9u428",
		"registrationNO": "3y84y89",
		"licensePic": "hgfuygw",
		"email": "nmmashnoor@gmail.com",
		"registrationPic": "778787834",
		"userPic": "7777",
		"date": "27\/12\/1997",
		"shareCode": "999333",
		"firstRide": 0,
		"token": "8888899",
		"address":"uhuih"
	}
}
```
####Set Current Location
Link: /setcurrentlocation

Method: POST
```
token: String
```

On Response
```
{
	"response": "current location stored successfully",
	
}
```
####Get Free Riders
Link: /getfreeriders
```
token: String
lat: String
lng: String
```

On Success
```
[
	{
		"id": 1,
		"userCustomer_id": 1,
		"userRider_id": 1,
		"lat": "29.888",
		"lng": "777.333",
		"rotation": 89,
		"free": 1,
		"lastOnline": "2017-09-03"
	},
	{
		"id": 2,
		"userCustomer_id": 1,
		"userRider_id": 1,
		"lat": "29.888",
		"lng": "777.333",
		"rotation": 89,
		"free": 1,
		"lastOnline": "2017-09-03"
	}
]
```

On Failure
```
{
	"response": "token didn't match"
}
```

####Set Complain
Link: /setcomplain

Method: POST
```
message: String
userCustomer_id: String
userRider_id: String
```

On Response
```
{
	"response": "complain added successfully",
	
}
```

####Get Rider Profile
Link: /getriderprofile

Method: POST
```
token: String
phone: String
```

#####On Response
On Success
```
{
	{
        "result": "success",
        "userdata": {
            "id": 5,
            "name": "Saif",
            "phone": "01722043601",
            "email": "email",
            "nidNumber": "nid number",
            "licenseNO": "license no",
            "registrationNO": "regis no",
            "licensePic": "pic",
            "registrationPic": "pic",
            "userPic": "pic",
            "date": "2017-09-06",
            "shareCode": "null",
            "firstRide": 0,
            "token": "fXFm4jozZjs:APA91bEFl6F_UJwGBJMmOSE4jhc_lg3O3LU0E0XOzrP4mkY_ejnpjibziPPmzf60DTuUpMqrWigCDakgP4zYUtK1lMfS-Ob5-gDI9vBzV054LdscyuMrAeBWq3XEqsvQ5Im1VTMCmlCD",
            "status": "pending",
            "freelancer": 1,
            "address": null
        }
    }
	
}
```
On Failed
```
{
    "response": "couldn't find rider profile"
}
```
####Get Customer Profile
Link: /getcustomerprofile

Method: POST
```
token: String
phone: String
```

#####On Response
On Success
```
{
    "result": "success",
    "userdata": {
        "id": 12,
        "name": "hhhhh",
        "phone": "01887666",
        "email": "iiii@hhhhh",
        "picture": "ughghyuguyghyg",
        "date": "2017-09-22",
        "shareCode": "iiiiiddd",
        "firstRide": 1,
        "token": "iugwuiwgfuywg",
        "address": "iuguygfueriufgbjb befhuebvfhu bv"
    }
}
```
On Failed
```
{
    "response": "couldn't find customer profile"
}
```

####Get History
Link: /gethistory

Method: POST
```
token: String
```
#####On Response
On Success
