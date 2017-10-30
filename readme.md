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
status: String
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
customertoken: String
riderid: String
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
    "response": "success",
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
    },
    "rating": 3.5
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
```
{"response":"customer found successfully","histories":[{"id":7,"userCustomer_id":13,"origin":"'O-A' Pathshala","destLat":0,"originLng":0,"destination":"BRAC University Building 3","destLng":0,"originLat":0,"date":"2017-10-30","hour":13,"fare":30,"riderPercent":22.875,"companyPercent":7.625,"promoAmount":null,"promoCode_id":null,"userRider_id":8,"userShareCode_id":null,"historyId":"NRB1BF","travelDuration":1,"travelDistance":0,"rideStartTime":"","rideEndTime":""},{"id":8,"userCustomer_id":13,"origin":"'O-A' Pathshala","destLat":0,"originLng":0,"destination":"BRAC University Building 3","destLng":0,"originLat":0,"date":"2017-10-30","hour":16,"fare":32,"riderPercent":24,"companyPercent":8,"promoAmount":null,"promoCode_id":null,"userRider_id":8,"userShareCode_id":null,"historyId":"JV8O0E","travelDuration":4,"travelDistance":0,"rideStartTime":"","rideEndTime":""},{"id":9,"userCustomer_id":13,"origin":"'O-A' Pathshala","destLat":0,"originLng":0,"destination":"BRAC University Building 3","destLng":0,"originLat":0,"date":"2017-10-30","hour":16,"fare":30,"riderPercent":22.5,"companyPercent":7.5,"promoAmount":null,"promoCode_id":null,"userRider_id":8,"userShareCode_id":null,"historyId":"AZBB9N","travelDuration":0,"travelDistance":0,"rideStartTime":"","rideEndTime":""},{"id":10,"userCustomer_id":13,"origin":"'O-A' Pathshala","destLat":0,"originLng":0,"destination":"Jatra Bari","destLng":0,"originLat":0,"date":"2017-10-30","hour":18,"fare":30,"riderPercent":22.5,"companyPercent":7.5,"promoAmount":null,"promoCode_id":null,"userRider_id":8,"userShareCode_id":null,"historyId":"OG0TGR","travelDuration":0,"travelDistance":0,"rideStartTime":"","rideEndTime":""},{"id":11,"userCustomer_id":13,"origin":"'O-A' Pathshala","destLat":0,"originLng":0,"destination":"Jatra Bari","destLng":0,"originLat":0,"date":"2017-10-30","hour":18,"fare":31,"riderPercent":23.25,"companyPercent":7.75,"promoAmount":null,"promoCode_id":null,"userRider_id":8,"userShareCode_id":null,"historyId":"TOIJ7D","travelDuration":2,"travelDistance":0,"rideStartTime":"","rideEndTime":""},{"id":12,"userCustomer_id":13,"origin":"'O-A' Pathshala","destLat":0,"originLng":0,"destination":"BRAC University Building 3","destLng":0,"originLat":0,"date":"2017-10-30","hour":18,"fare":30,"riderPercent":22.5,"companyPercent":7.5,"promoAmount":null,"promoCode_id":null,"userRider_id":8,"userShareCode_id":null,"historyId":"PJO9VK","travelDuration":0,"travelDistance":0,"rideStartTime":"","rideEndTime":""},{"id":13,"userCustomer_id":13,"origin":"'O-A' Pathshala","destLat":0,"originLng":0,"destination":"BRAC University Building 3","destLng":0,"originLat":0,"date":"2017-10-30","hour":18,"fare":30,"riderPercent":22.875,"companyPercent":7.625,"promoAmount":null,"promoCode_id":null,"userRider_id":8,"userShareCode_id":null,"historyId":"0KP9PV","travelDuration":1,"travelDistance":0,"rideStartTime":"","rideEndTime":""},{"id":14,"userCustomer_id":13,"origin":"'O-A' Pathshala","destLat":0,"originLng":0,"destination":"BRAC University Building 3","destLng":0,"originLat":0,"date":"2017-10-30","hour":18,"fare":30,"riderPercent":22.5,"companyPercent":7.5,"promoAmount":null,"promoCode_id":null,"userRider_id":8,"userShareCode_id":null,"historyId":"DDZATI","travelDuration":0,"travelDistance":0,"rideStartTime":"","rideEndTime":""},{"id":15,"userCustomer_id":13,"origin":"'O-A' Pathshala","destLat":0,"originLng":0,"destination":"BRAC University Building 3","destLng":0,"originLat":0,"date":"2017-10-30","hour":18,"fare":30,"riderPercent":22.5,"companyPercent":7.5,"promoAmount":null,"promoCode_id":null,"userRider_id":8,"userShareCode_id":null,"historyId":"VKHW98","travelDuration":0,"travelDistance":0,"rideStartTime":"","rideEndTime":""}]}
```
On Failure
```
{"result":"user not found"}
```

####Set Unsuccessful Ride
Link: /setunsuccessfulride

Method: POST
```
customerid: String (Default Null)
riderid: String (Default Null)
causetype: String (1 --> byRider, 2-->byCustomer, 3-->byRiderNotFound)
```
#####On Response
On Success
```
{
	"response": "success",
	"unsuccessfulridedetail": {
		"userCustomer_id": "1",
		"userRider_id": "1",
		"unsuccessfullRideType_id": 1,
		"date": "2017-09-26",
		"id": 1
	}
}
```
####Get Rider Profile (By Phone)
Link: /getriderprofilebyphone

Method: POST
```
riderphone: String
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
    "response": "couldn't find rider"
}
```

####Send Notification
Link: /sendnotification

Method: POST
```
sender_token: String
receiver_token: String
message: String
```
#####On Response
```
{"multicast_id":8190131147677521934,"success":1,"failure":0,"canonical_ids":0,"results":[{"message_id":"0:1506842881671812%b797635af9fd7ecd"}]}
```
####Set Rating
Link: /sendnotification

Method: POST
```
customer_id: String
rider_id: String
value: String
rate_by: String (0 For By Rider, 1 for By customer)
```
#####On Response
```
{
    "response": "success"
}
```
####Set History
Link: /sethistory

Method: POST
```
userCustomer_id
origin
destination
userRider_id
distance (in km)
duration (in minute)
destLat
originLng
destLng
originLat
rideStartTime
rideEndTime
```
#####On Response
```
{"response":"success","detail":{"userCustomer_id":"16","origin":"Uttara","destination":"Shahbag","date":"2017-10-30","hour":"23","fare":210,"riderPercent":157.5,"companyPercent":52.5,"userRider_id":"4","historyId":"UFEBRV","travelDuration":90,"travelDistance":9,"destLat":"45","originLng":"56","destLng":"88","originLat":"66","rideStartTime":"22:40","rideEndTime":"23:40","promoAmount":0,"id":16}}
```
####Get Noticeoard
Link: /getnoticeboard/{type}

type = (rider/customer)

Method: GET

#####On Response
```
[{"id":2,"message":"this is for rider","reciverType":"0","date":"2017-10-02"}]
```
####Apply Promo
Link: /applypromo


Method: POST
```
token
promocode
```
#####On Invalid User
```
{
    "response": "token invalid"
}
```
#####On Invalid Promo
```
{
       "response": "promo invalid"
}
```
#####On Success 
```
{
    "response": "promo applied successfully",
    "percentage": "50"
}
```
####Get Specific Noticeoard
Link: /getspecificnotice

Method: POST
```
id
who: (rider/customer)
```

#####On Response
```
[
    {
        "id": 1,
        "message": "This is a notice",
        "noticeBoardcol": "notice",
        "userRider_id": 16,
        "userCustomer_id": null
    }
]
```