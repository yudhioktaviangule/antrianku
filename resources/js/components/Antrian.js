const { default: axios } = require("axios");
const SERVER_KEY = 'AAAARQn8ZkE:APA91bEjb7DDXiswDeYcAjBb5RBJx3lrcgXgNl36yFwuDFgCcaT5yhQYvLfGMDtMOEkJQOLIVmLgZb9LOa24YYoDRz0PZTVoUwoJLWnNGsrqHHEYgnVfkcgoNjjGxHQ6_0pzBCc5aVG2';
class Antrian{
    _token 
    
    constructor(){
        this._token = $("tok").attr('token');
    }
    async getAntrian(){
        let url ="api/antriapi";
        const {data} = await axios.get(url,{
            headers:{
                'Content-Type':'Application/json',
                'Keyauth':`Bearer ${this._token}`
            }
        });
        return data;
    }
    async sender(){
        let tokenAntrian = $("token_antri").attr('token');
        tokenAntrian = tokenAntrian.split("_ANTRIAN_");
        const {data:resultFirebase} = await axios.post('https://fcm.googleapis.com/fcm/send',{
            registration_ids:tokenAntrian,
            message:"next antrian"
        },{headers:{
            'Content-Type':'application/json',
            'Accept':'application/json',
            'Authorization':`key=${SERVER_KEY}`,
        }});
    }
    async prosesAntrian(){
        let url ="api/antriapi/create";
        const {data:proses} = await axios.get(url,{
            headers:{
                'Content-Type':'Application/json',
                'Keyauth':`Bearer ${this._token}`
            }
        });
        await this.sender();
        return proses;
    }
    async get(id){
        const url =`api/antriapi/${id}`;

        const {data:proses} = await axios.get(url,{
            headers:{
                'Content-Type':'Application/json',
                'Keyauth':`Bearer ${this._token}`
            }
        });
        return proses;
    }
}

window.antrianClass = ()=>{
    return new Antrian();
}