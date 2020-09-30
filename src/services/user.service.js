import baseAPI from "../api";
import authHeader from './auth-header';

class UserService {
    getProfile() {
        return baseAPI('/user/profile', 'GET', null, authHeader());
    }

    getBorrows(borrowStatus = null) {
        if (borrowStatus != null) {
            return baseAPI('/user/borrows', 'GET', null, authHeader(), {
                borrowstatus: borrowStatus
            });
        }
        return baseAPI('/user/borrows', 'GET', null, authHeader());
    }

    getAll() {
        return baseAPI('/users', 'GET', null, authHeader());
    }
}

export default new UserService();