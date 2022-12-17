export const getCheckBuildStatus = (isReady: boolean): string => {
	return isReady ? 'Сборка готова' : 'Сборка не готова';
};
