var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res,next) {
	console.log('Index router');
	res.render('classelement', { pagetitle: 'Etomon',classname:'Music · Havana', classdescription:'Learn salsa at a rooftop studio',classfee:'233',numofreviews:'7',classratingstar:3 });
});

module.exports = router;
