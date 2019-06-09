const apiDomain = '/api/v1';

export const siteName = Laravel.siteName;

export const api = {
	clientSecret : Laravel.clientSecret,
	clientId : Laravel.clientId,
	setting :  apiDomain + '/setting',
	category_home :  apiDomain + '/category_home',
	galery_home :  apiDomain + '/galery_home',
	// login: '/oauth/token',
	// register : apiDomain + '/register',
};
