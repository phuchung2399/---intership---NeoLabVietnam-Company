import axios from "axios";
const API_URL = "http://localhost:8000/api/v1";

export default async function baseAPI(uri, method, dataBody = null, headers = {}, params = {}) {
    const url = API_URL.concat(uri);

    // const data = dataBody ? JSON.stringify(dataBody) : null;
    const data = dataBody ? dataBody : null;

    headers["Accept"] = "application/json";
    headers["Content-Type"] = headers["Content-Type"] ? headers["Content-Type"] : "application/json";

    return axios({
        method: method,
        url: url,
        headers: headers,
        params: params,
        data: data
    }).then(function (response) {
        return response;
    });
}