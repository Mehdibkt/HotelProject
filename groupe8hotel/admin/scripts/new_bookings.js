function get_bookings(search='')
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/new_bookings.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function(){
    document.getElementById('table-data').innerHTML = this.responseText;
  }

  xhr.send('get_bookings&search='+search);
}

function toggle_status(id, val) { 
  
  val = val === 0 ? 1 : 0;

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/new_bookings.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Status toggled!');
      get_bookings();
    } else {
      alert('success', 'Server Down!');
    }
  }

  xhr.send('toggle_status=' + id + '&value=' + val);
}




window.onload = function(){
  get_bookings();
}