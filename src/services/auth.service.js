import baseAPI from "../api/index";

class AuthService {

    async authRequest() {
        return await baseAPI('/auth-google', 'GET');
    }

    authCheck(accessToken) {
        return baseAPI('/user', 'GET', null, { Authorization: 'Bearer ' + accessToken });
    }

    logout() {
        localStorage.removeItem('access-token');
    }
}

export default new AuthService();