import { Deserializable } from './deserializable.model';

export class Profile implements Deserializable {
  user_id: string;
  firstName: string;
  lastName: string;
  address: string;
  phone: string;
  deserialize(input: any): this {
    Object.assign(this, input);
    
    return this;
  };
  
  
}