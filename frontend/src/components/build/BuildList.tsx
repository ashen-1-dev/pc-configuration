import React, { FC } from 'react';
import { GetBuildDto } from '../../models/build/get-build.dto';
import BuildItem from './BuildItem';

interface BuildListProps {
	builds: GetBuildDto[];
	onBuildAdd?: (build: GetBuildDto) => void;
	onBuildDelete?: (build: GetBuildDto) => void;
	onBuildUpdate?: (build: GetBuildDto) => void;
}

const BuildList: FC<BuildListProps> = ({
	builds,
	onBuildDelete,
	onBuildUpdate,
	onBuildAdd,
}) => {
	return (
		<div>
			{builds.map(build => (
				<BuildItem
					key={build.id}
					onBuildDelete={onBuildDelete}
					onBuildUpdate={onBuildUpdate}
					onBuildAdd={onBuildAdd}
					build={build}
				/>
			))}
		</div>
	);
};

export default BuildList;
