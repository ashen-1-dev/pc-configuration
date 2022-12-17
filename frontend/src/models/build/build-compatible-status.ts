import { GetComponentDto } from '../component/get-component.dto';

export class BuildCompatibleStatus {
	public isCompatible: boolean;
	public componentsStatus: ComponentStatus[];
}

export class ComponentStatus {
	public componentId: number;
	public isCompatible: boolean;
	public notCompatibleComponents?: NotCompatibleComponents[];
}

export class NotCompatibleComponents {
	public component: GetComponentDto;
	public message?: string;
}
