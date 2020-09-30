import baseAPI from "../api";
import authHeader from './auth-header';

class DeviceService {
    getAll() {
        return baseAPI('/devices', 'GET', null, authHeader());
    }
    getById(id) {
        return baseAPI('/devices/' + id, 'GET', null, authHeader());
    }
    getRelatedById(id) {
        return baseAPI('/devices/' + id + '/related', 'GET', null, authHeader());
    }
    create(data) {
        const headers = {
            'Content-Type': 'multipart/form-data'
        };
        return baseAPI('/devices', 'POST', data, authHeader(), headers);
    }
    update(id, data) {
        return baseAPI('/devices/' + id, 'PUT', data, authHeader());
    }
    delete(id) {
        return baseAPI('/devices/' + id, 'DELETE', null, authHeader());
    }
}

export default new DeviceService();