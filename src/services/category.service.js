import baseAPI from "../api";
import authHeader from './auth-header';

class CategoryService {
    getAll() {
        return baseAPI('/categories', 'GET', null, authHeader());
    }

    getById(id) {
        return baseAPI('/categories/' + id, 'GET', null, authHeader());
    }

    create(data) {
        const headers = {
            'Content-Type': 'multipart/form-data'
        };
        return baseAPI('/categories', 'POST', data, authHeader(), headers);
    }

    update(id, data) {
        return baseAPI('/categories/' + id, 'PUT', data, authHeader());
    }

    delete(id) {
        return baseAPI('/categories/' + id, 'DELETE', null, authHeader());
    }
}

export default new CategoryService();