function Contact(id) {
  this.id = id;

  this.get_name = function(id) {
    return "test_" + id;
  }

  this.name = this.get_name(id);
}
 
var test = new Contact(12)

console.log(test.name)