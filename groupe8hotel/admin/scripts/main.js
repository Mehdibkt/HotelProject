let add_chain_form = document.getElementById('add_chain_form');
    
    add_chain_form.addEventListener('submit',function(e){
      e.preventDefault();
      add_chain();
    });
    
    function add_chain()
    {
      let data = new FormData();
      data.append('add_chain','');
      data.append('name',add_chain_form.elements['name'].value);
      data.append('nb_hotels',add_chain_form.elements['nb_hotels'].value);
      data.append('c_address',add_chain_form.elements['c_address'].value);
      data.append('c_email',add_chain_form.elements['c_email'].value);
      data.append('c_pn',add_chain_form.elements['c_pn'].value);
   
    
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/main.php",true);
    
      xhr.onload = function(){
        var myModal = document.getElementById('add-chain');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
    
        if(this.responseText == 1){
          get_all_chains();
          alert('success','New chain added!');
          add_chain_form.reset();
          
        }
        else{
          alert('error','Server Down!');
        }
      }
      console.log(data);
      xhr.send(data);
    }

  function get_all_chains(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/main.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
      document.getElementById('chain-data').innerHTML = this.responseText;
    }

    xhr.send('get_all_chains');
}

let edit_chain_form = document.getElementById('edit_chain_form');


    
    function edit_details(id){
      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/main.php",true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = function(){
      let data = JSON.parse(this.responseText);

      edit_chain_form.elements['name'].value = data.chaindata.name;
      edit_chain_form.elements['nb_hotels'].value = data.chaindata.nb_hotels;
      edit_chain_form.elements['c_address'].value = data.chaindata.c_address;
      edit_chain_form.elements['c_email'].value = data.chaindata.c_email;
      edit_chain_form.elements['c_pn'].value = data.chaindata.c_pn;
      edit_chain_form.elements['chain_id'].value = data.chaindata.chain_id;

      }
      xhr.send('get_chain='+id);
}
      

edit_chain_form.addEventListener('submit',function(e){
  e.preventDefault();
  submit_edit_chain();
});

function submit_edit_chain()
{
  let data = new FormData();
  data.append('edit_chain','');
  data.append('name',edit_chain_form.elements['name'].value);
  data.append('chain_id',edit_chain_form.elements['chain_id'].value);
  data.append('nb_hotels',edit_chain_form.elements['nb_hotels'].value);
  data.append('c_address',edit_chain_form.elements['c_address'].value);
  data.append('c_email',edit_chain_form.elements['c_email'].value);
  data.append('c_pn',edit_chain_form.elements['c_pn'].value);

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/main.php",true);

  xhr.onload = function(){
    var myModal = document.getElementById('edit-chain');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if(this.responseText == 1){
      alert('success','Chain data edited!');
      edit_chain_form.reset();
      get_all_chains();
    }
    else{
      alert('error','Server Down!');
    }
  }

  xhr.send(data);
}



let add_image_form = document.getElementById('add_image_form');

add_image_form.addEventListener('submit',function(e){
  e.preventDefault();
  add_image();
});

function add_image()
{
  let data = new FormData();
  data.append('image',add_image_form.elements['image'].files[0]);
  data.append('chain_id',add_image_form.elements['chain_id'].value);
  data.append('add_image','');

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/main.php",true);

  xhr.onload = function()
  {
    if(this.responseText == 'inv_img'){
      alert('error','Only JPG, WEBP or PNG images are allowed!','image-alert');
    }
    else if(this.responseText == 'inv_size'){
      alert('error','Image should be less than 2MB!','image-alert');
    }
    else if(this.responseText == 'upd_failed'){
      alert('error','Image upload failed. Server Down!','image-alert');
    }
    else{
      alert('success','New image added!','image-alert');
      chain_images(add_image_form.elements['chain_id'].value,document.querySelector("#chain-images .modal-title").innerText)
      add_image_form.reset();
    }
  }
  xhr.send(data);
}

function chain_images(id,rname)
{
  document.querySelector("#chain-images .modal-title").innerText = rname;
  add_image_form.elements['chain_id'].value = id;
  add_image_form.elements['image'].value = '';

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/main.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function(){
    document.getElementById('chain-image-data').innerHTML = this.responseText;
  }

  xhr.send('get_chain_images='+id);
}

function rem_image(img_id,chain_id)
{
  let data = new FormData();
  data.append('image_id',img_id);
  data.append('chain_id',chain_id);
  data.append('rem_image','');

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/main.php",true);

  xhr.onload = function()
  {
    if(this.responseText == 1){
      alert('success','Image Removed!','image-alert');
      chain_images(chain_id,document.querySelector("#chain-images .modal-title").innerText);
    }
    else{
      alert('error','Image removal failed!','image-alert');
    }
  }
  xhr.send(data);  
}

function thumb_image(img_id,chain_id)
{
  let data = new FormData();
  data.append('image_id',img_id);
  data.append('chain_id',chain_id);
  data.append('thumb_image','');

  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/main.php",true);

  xhr.onload = function()
  {
    if(this.responseText == 1){
      alert('success','Image Thumbnail Changed!','image-alert');
      chain_images(chain_id,document.querySelector("#chain-images .modal-title").innerText);
    }
    else{
      alert('error','Thumbnail update failed!','image-alert');
    }
  }
  xhr.send(data);  
}

function remove_chain(chain_id)
{
  if(confirm("Are you sure, you want to delete this chain?"))
  {
    let data = new FormData();
    data.append('chain_id',chain_id);
    data.append('remove_chain','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/main.php",true);

    xhr.onload = function()
    {
      if(this.responseText == 1){
        get_all_chains();
        alert('success','Chain Removed!');
        
      }
      else{
        alert('error','Chain removal failed!');
      }
    }
    xhr.send(data);
  }

}

window.onload = function(){
  get_all_chains();}
