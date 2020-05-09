import { Deserializable } from './deserializable.model';

export class Profile implements Deserializable {
  user_id: string;
  firstname: string;
  lastname: string;
  address: string;
  phone: string;
  email: string;
  password: string;
  password_confirmation: string;
  deserialize(input: any): this {
    Object.assign(this, input);
    
    return this;
  };
  
  
}