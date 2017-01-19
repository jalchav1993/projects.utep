// app/models/account.js
// grab the mongoose module
var mongoose = require('mongoose');

// define our nerd model
// module.exports allows us to pass this to other files when it is called
module.exports = mongoose.model('Account', {
  fname : {type : String, default: ''},
	mname : {type : String, default: ''},
	lname : {type : String, default: ''},
	aid : {type : String, default: ''},
	cdate : {type : String, default: ''},
	age : {type : String, default: ''},
	country : {type : String, default: ''},
	city : {type : String, default: ''},
	state : {type : String, default: ''},
	phone: {type : String, default: ''}
});