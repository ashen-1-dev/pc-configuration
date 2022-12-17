import React, { FC } from 'react';
import { CheckBuildResult } from '../../models/build/check-build.result';
import { Row, Typography } from 'antd';
import { getCheckBuildStatus } from '../../models/build-ready-status/check-build-status';

interface CheckStatusProps {
	checkStatus: CheckBuildResult;
}

const CheckStatus: FC<CheckStatusProps> = ({ checkStatus }) => {
	const {
		energyConsumptionStatus,
		requirementComponentsStatus,
		buildCompatibleStatus,
		isReady,
	} = checkStatus;
	return (
		<div style={{ width: '50%' }}>
			<Row
				justify={'center'}
				align={'middle'}
				style={{
					backgroundColor: isReady
						? 'rgba(72, 157, 161, 0.49)'
						: '#de8181',
					minHeight: '50px',
				}}
			>
				<Typography.Title level={4}>
					{getCheckBuildStatus(isReady)}
				</Typography.Title>
			</Row>
			<Row>
				{!buildCompatibleStatus.isCompatible && (
					<div>Сборка имеет не совместимые комплектующие</div>
				)}
			</Row>
			<Row>
				{!energyConsumptionStatus.isEnough && (
					<div>Не хватает питание</div>
				)}
			</Row>
		</div>
	);
};

export default CheckStatus;
