import { useEffect, useState } from "react"
import axios from "axios";
export default function ImageList(){
    const [APIData, setAPIData] = useState([]);
    useEffect(()=>{
        // e.preventDefault();
        axios.get('http://127.0.0.1:8000/api/getImageUploaded')
        .then((response) => {
            // console.log(response.data.datas);
            setAPIData(response.data.datas);
        })
    },[]);

    const handledownload = (id)=>{
        // console.log(id);
        axios.get(`api/downloadFile/${id}`)
        .then((response)=>{
            console.log('ok');
        });
    }

    return(<><h2>Uploaded Image List</h2>
    <table>
        <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Download</th>

                </tr>
            </thead>
            <tbody>
               {
                 APIData.map((data, index)=>{
                    var image  = '/image/'+data.filename;
                    var extension = image.split('.').pop();
                    if (extension == 'pdf') {
                    var image_icon  = '/image/'+'pdf1.jpg';
                    } else{
                        var image_icon  = '/image/'+data.filename;
                    }
                   
                    return(
                        <tr key={data.id}>
                        <th scope="row">{index}</th>
                        <td><img src={image_icon} style={{width:"70px",height:"70px"}}></img></td>
                        <td><a href={image} download><button onClick={(e)=>handledownload(data.id)} className="btn btn-primary">download</button></a></td>
                        </tr>
                    )
                })
              }
            </tbody>
    </table>
    </>
    )
}