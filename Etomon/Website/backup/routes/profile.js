var express = require('express');
var router = express.Router();

\

/* GET home page. */

router.get('/', function(req, res,next) {
	res.cookie('name', 'express');
	console.log('Profile router');
	user={
		firstName : 'abc'
		,lastName : 'def'
		,phonenum : '9175171618'
		,location : 'new york'
		,email : 'etomon@gmail.com'
		,sex : 'Other'
		,dayOfBirth : '07/21/1992'
		,userId : 'ACXADAD'
	};
	console.log(user.firstName);
	res.render('profile', user);
});



router.post('/update',function(req,res,next){
	console.log(req.cookies.name);

	console.log(req.cookies);
	console.log(req.body);
});

module.exports = router;
