const apiDomain = '/api/v1';

export const siteName = Laravel.siteName;

export const api = {
	clientSecret : Laravel.clientSecret,
	clientId : Laravel.clientId,
	setting :  apiDomain + '/setting',
	category_home :  apiDomain + '/category_home',
	galery_home :  apiDomain + '/galery_home',
	sidebar :  apiDomain + '/sidebar',
	news :  apiDomain + '/news',
	news_detail: apiDomain +'/news_detail',
	news_detail_related: apiDomain +'/news_detail_related',
	news_detail_comment: apiDomain + '/news_detail_comment',
	// login: '/oauth/token',
	// register : apiDomain + '/register',
};
