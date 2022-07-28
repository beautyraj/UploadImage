// resources/js/components/HelloReact.js

import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import { NavLink } from 'react-router-dom';
import ImageList from './ImageList';
export default function HelloReact() {
    const[image,setFile] = useState("");
    const[message,setMessage] = useState("");
    const handleUpload = (e)=>{
        e.preventDefault();
        const formData = new FormData();
        formData.append('Image', image);
        fetch('http://127.0.0.1:8000/api/upload-image', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            // console.log(data)
            setMessage(data.message);
            window.location.reload(false);
          })
          .catch(error => {
            console.error('error');
          })
    }
    return(<div className="container">
    <div className="row">
     <div className="col-md-4 offset-md-4">
    <h3>Upload Image here</h3>
     <form method="post">
    <input type="file" className="form-control" name="image" onChange={(e)=>{setFile(e.target.files[0])}}></input>
    <button type="submit" className ="btn btn-primary" name="submit" onClick={handleUpload}>Upload</button>
    <br></br>
    </form>
    <span className='text-success'>{message}</span>
     </div>
    </div>
    <ImageList />
    
    </div>
    )
}

if (document.getElementById('hello-react')) {
    ReactDOM.render(<HelloReact />, document.getElementById('hello-react'));
}