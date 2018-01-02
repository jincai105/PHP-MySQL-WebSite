var express = require('express');
var router = express.Router();

/* GET users listing. */
router.get('/', function(req, res, next) {
	console.log('users router');
	console.log(req.body.title);
    console.log(req.body.description);
    res.render('users', { title: 'Register' });
});

router.post('/', function (req, res) {
    console.log(req.body.title);
    console.log(req.body.description);
    res.send('Post page');
});

module.exports = router;
