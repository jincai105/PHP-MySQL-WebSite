var express = require('express');
var router = express.Router();

/* GET home page. */

router.get('/', function(req, res,next) {
	console.log('Profile router');
	course={
		name : 'Introduction to CS'
    ,imgurl: ''
		,description : `The Institute of Electrical and Electronics Engineers (IEEE) is a professional association with its corporate office in New York City and its operations center in Piscataway, New Jersey. It was formed in 1963 from the amalgamation of the American Institute of Electrical Engineers and the Institute of Radio Engineers. Today, it is the world's largest association of technical professionals with more than 420,000 members in over 160 countries around the world. Its objectives are the educational and technical advancement of electrical and electronic engineering, telecommunications, computer engineering and allied disciplines.[2]`
		,time : 'Web 9:00 Pm to 11 Pm<br></br>Sat 6:00 Pm to 8 Pm'
		,teacher : 'who knows'
		,teacherEmail : 'etomon@gmail.com'
		,grade : 'SSS'
    ,num:7
		,userId : 'IEEE001'
	};
	res.render('StudentSingleCourse', course);
});

module.exports = router;
