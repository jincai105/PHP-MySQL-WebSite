var express = require('express');
var router = express.Router();

/* GET home page. */

router.get('/', function(req, res,next) {
	console.log('Profile router');
	courseName = 'IEEE001';
	previousReviews=[{
    name:'General'
    ,description:'Do you like it?'
    ,rating:5
    ,comment:'IEEE001 is great'
	}
  ,{
    name:'Cousrse Quality'
    ,description:'Teacher performance'
		,rating:4
    ,comment:'Teahcer is great'
  }
  ,{
    name:'Recommend'
    ,description:'Will you recommend it to other'
		,rating:1
    ,comment:'oops'
  }
];
	res.render('sReview', {courseName,previousReviews});
});

module.exports = router;
