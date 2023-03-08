// @ts-ignore
export const dummyRequest = ({onSuccess}): void => {
	setTimeout(() => {
		onSuccess('ok');
	}, 0);
};