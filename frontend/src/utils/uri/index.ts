export function getUrlQueryStringFromObject(params: any): string {
	if (params == null) {
		return '';
	}
	return Object.keys(params)
		.map(
			key =>
				`${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`,
		)
		.join('&');
}
