import baseAPI from "../api";
import authHeader from './auth-header';

class BorrowService {
    getAll() {
        return baseAPI('/borrows', 'GET', null, authHeader());
    }
    getById(id) {
        return baseAPI('/borrows/' + id, 'GET', null, authHeader());
    }
    create(data) {
        return baseAPI('/borrows', 'POST', data, authHeader());
    }
}

export default new BorrowService();