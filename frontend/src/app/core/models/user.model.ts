import { Deserializable } from './deserializable.model';
import { Order } from './order.model';
import { Profile } from './profile.model';

export class User implements Deserializable {
  profile: Profile;
  orders: Order[];
  deserialize(input: any): this {
    this.profile = new Profile().deserialize(input.profile);
    this.orders = input.orders.map(el => new Order().deserialize(el));;
    
    return this;
  };
}