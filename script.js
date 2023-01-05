function loadTable() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://localhost/test/javan/api");
    xhttp.send();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        coba = this.responseText;
        console.log(coba);
        var trHTML = ''; 
        const objects = JSON.parse(this.responseText);
        for (let object of objects) {
          trHTML += '<tr>'; 
          trHTML += '<td>'+object['id']+'</td>';
          trHTML += '<td>'+object['name']+'</td>';
          trHTML += '<td>'+object['gender']+'</td>';
          trHTML += '<td><button type="button" class="btn btn-outline-secondary" onclick="showUserEditBox('+object['id']+')">Edit</button>';
          trHTML += '<button type="button" class="btn btn-outline-danger" onclick="userDelete('+object['id']+')">Del</button></td>';
          trHTML += "</tr>";
        }
        document.getElementById("mytable").innerHTML = trHTML;
      }
    };
  }
  
  loadTable();
  
  function loadParent(s) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://localhost/test/javan/api");
    xhttp.send();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        coba = this.responseText;
        // console.log(coba);
        var trHTML = ''; 
        const objects = JSON.parse(this.responseText);
        trHTML += '<option></option>';
        console.log(s);
        if(!s){
            for (let object of objects) {
                trHTML += '<option value='+object['id']+' >'+object['name']+'</option>';
            }
        }else{
            for (let object of objects) {
                if(object['id']==s){
                    trHTML += '<option value='+object['id']+' selected >'+object['name']+'</option>';
                }
                trHTML += '<option value='+object['id']+'>'+object['name']+'</option>';
            }
        }
        document.getElementById("parents").innerHTML = trHTML;
      }
    };
  }


  function showUserCreateBox() {
    Swal.fire({
      title: 'Create user',
      html:
        '<input id="id" type="hidden">' +
        'Name <input id="name" class="swal2-input" placeholder="Name">' +
        '<br>Gender <select id="gender" class="swal2-input"><option value="Female">Female</option><option value="Male">Male</option></select>'+
        '<br>Parent <select id="parents" class="swal2-input">'+loadParent()+'</select>',
      focusConfirm: false,
      preConfirm: () => {
        userCreate();
      }
    })
  }
  
  function userCreate() {
    const name = document.getElementById("name").value;
    const gender = document.getElementById("gender").value;
    const parent = document.getElementById("parents").value;
    console.log(parent);
      
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "http://localhost/test/javan/api");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.send(JSON.stringify({ 
      "name": name, "gender": gender, "parent": parent
    }));
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const objects = JSON.parse(this.responseText);
        Swal.fire(objects['message']);
        loadTable();
      }
    };
  }

//   EDIT

  function showUserEditBox(id) {
    console.log(id);
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://localhost/test/javan/api/personwithparent/"+id);
    xhttp.send();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const objects = JSON.parse(this.responseText);
        const user = objects['data'][0];
        var selectgender = '';
        console.log(user['gender']);
        if(user['gender']=='Female'){
            selectgender = '<select id="gender" class="swal2-input"><option value="Female" selected>Female</option><option value="Male">Male</option></select>';
        }else{
            selectgender = '<select id="gender" class="swal2-input"><option value="Female">Female</option><option value="Male" selected>Male</option></select>'
        }

        console.log(user['parent']);

        Swal.fire({
          title: 'Edit User',
          html:
            '<input id="id" type="hidden" value='+user['id']+'>' +
            'Name <input id="name" class="swal2-input" placeholder="Name" value="'+user['name']+'">' +
            '<br>Gender '+ selectgender +
            '<br>Parent <select id="parents" class="swal2-input">'+loadParent(user['parent'])+'</select>',
          focusConfirm: false,
          preConfirm: () => {
            userEdit();
          }
        })
      }
    };
  }
  
  function userEdit() {
    const id = document.getElementById("id").value;
    const name = document.getElementById("name").value;
    const gender = document.getElementById("gender").value;
    const parent = document.getElementById("parents").value;
      
    const xhttp = new XMLHttpRequest();
    xhttp.open("PUT", "http://localhost/test/javan/api");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.send(JSON.stringify({ 
      "id": id, "name": name, "gender": gender, "parent": parent 
    }));
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const objects = JSON.parse(this.responseText);
        Swal.fire(objects['message']);
        loadTable();
      }
    };
  }

//   DELETE

  function userDelete(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("DELETE", "http://localhost/test/javan/api");
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhttp.send(JSON.stringify({ 
      "id": id
    }));
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4) {
        const objects = JSON.parse(this.responseText);
        Swal.fire(objects['message']);
        loadTable();
      } 
    };
  }