import React, { FC, useContext, useState } from 'react';
import { Button, Card, Image, List, Typography } from 'antd';
import { getCheckBuildStatus } from '../../models/build-ready-status/check-build-status';
import { GetBuildDto } from '../../models/build/get-build.dto';
import { UserContext } from '../../App';

interface BuildItemProps {
	build: GetBuildDto;
	onBuildAdd?: (build: GetBuildDto) => void;
	onBuildDelete?: (build: GetBuildDto) => void;
	onBuildUpdate?: (build: GetBuildDto) => void;
}

const BuildItem: FC<BuildItemProps> = ({
	build,
	onBuildDelete,
	onBuildUpdate,
	onBuildAdd,
}) => {
	const user = useContext(UserContext);
	const [isAdded, setIsAdded] = useState(false);

	const handleOnAdd = (build: GetBuildDto) => {
		onBuildAdd != null && onBuildAdd(build);
		setIsAdded(true);
	};

	const handleOnUpdate = (build: GetBuildDto) => {
		onBuildUpdate != null && onBuildUpdate(build);
	};

	const handleOnDelete = (build: GetBuildDto) => {
		onBuildDelete != null && onBuildDelete(build);
	};

	return (
		<div style={{ padding: '0 50px' }}>
			<Typography.Title level={4}>{build.name}</Typography.Title>
			<Typography.Text italic>
				{getCheckBuildStatus(build.isReady)}
			</Typography.Text>
			<br />
			<Typography.Paragraph>{build.description}</Typography.Paragraph>
			<Typography.Paragraph>
				Автор сборки: {build.user.firstName} {build.user.email}
			</Typography.Paragraph>
			<div>
				{build.user.id === user?.id ? (
					<div>
						<Button onClick={() => handleOnDelete(build)}>
							Удалить
						</Button>
						<Button onClick={() => handleOnUpdate(build)}>
							Изменить
						</Button>
					</div>
				) : (
					<div>
						{!isAdded ? (
							<Button onClick={() => handleOnAdd(build)}>
								Добавить к себе
							</Button>
						) : (
							<Button
								disabled
								style={{ backgroundColor: '#52c41a' }}
							>
								Добавлено
							</Button>
						)}
					</div>
				)}
			</div>
			<List
				grid={{ column: build.components.length }}
				dataSource={build.components}
				renderItem={component => (
					<List.Item>
						<Card title={component.name}>
							<Image
								width={100}
								height={100}
								src={component.photoUrl}
							/>
						</Card>
					</List.Item>
				)}
			/>
		</div>
	);
};

export default BuildItem;
