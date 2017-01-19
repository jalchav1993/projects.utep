 // app/routes.js
// grab the nerd model we just created
var Nerd = require('./models/nerd');
// grab the nerd model we just created
var Account = require('./models/account');
  module.exports = function(app) {
    // server routes ===========================================================
    // handle things like api calls
    // authentication routes
    // sample api route
    app.get('/api/nerds', function(req, res) {
      // use mongoose to get all nerds in the database
      Nerd.find(function(err, nerds) {
        // if there is an error retrieving, send the error. 
        // nothing after res.send(err) will execute
        if (err)
          res.send(err);
        res.json(nerds); // return all nerds in JSON format
      });
    });
		//app route for accounts
    app.get('/api/accounts/', function(req, res) {
      // use mongoose to get all accounts in the database
      Account.find(function(err, accounts) {
        // if there is an error retrieving, send the error. 
        // nothing after res.send(err) will execute
        if (err)
          res.send(err);
        res.json(accounts); // return all nerds in JSON format
      });
    });
		app.post('/api/accounts/', function(req, res) {
      // use mongoose to get all accounts in the database
			var buffer = req.body.params;
			var naccount = Account({
			  fname : buffer.fname,
				mname : buffer.mname,
				lname : buffer.lname,
				aid : buffer.aid,
				cdate : buffer.cdate,
				age : buffer.age,
				country : buffer.country,
				city : buffer.city,
				state : buffer.state,
				phone: buffer.phone
			});
      naccount.save(function(err) {
        // if there is an error retrieving, send the error. 
        // nothing after res.send(err) will execute
        if (err)
          res.send(err);
        res.send('accepted-req');
      });
    });
		app.delete('/api/accounts/:aid', function(req, res) {
			var buffer = req.params;
			var aid = {aid: buffer.aid};
			Account.find(aid, function(err, account){
				user.remove(function(err) {
					if (err) 
						res.send(err);
					res.send('accepted-req');
				});
			});
		});
    // route to handle creating goes here (app.post)
    // route to handle delete goes here (app.delete)
    // frontend routes =========================================================
    // route to handle all angular requests
    app.get('*', function(req, res) {
      res.sendfile('./public/views/index.html'); // load our public/index.html file
    });
  };