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
		"token": "0934885"
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
		"id": 3
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
		"token": "8888899"
	}
}
```
####Set Current Location
Link: /setcurrentlocation
```
userCustomer_id: int
userRider_id: int
lat: float
lng: float
rotation: float
free: int
lastOnline: date
```

On Response
```
{
	"response": "current location stored successfully",
	"currentlocation": {
		"userCustomer_id": "1",
		"userRider_id": "1",
		"lat": "29.888",
		"lng": "777.333",
		"rotation": "89",
		"free": "1",
		"lastOnline": "2017-09-03 00:22:48",
		"id": 2
	}
}
```