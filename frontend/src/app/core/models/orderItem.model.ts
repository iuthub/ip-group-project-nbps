import { Deserializable } from './deserializable.model';
import { Order } from './order.model';
import { Item } from './item.model';

export class OrderItem implements Deserializable {
  order: Order;
  item: Item;
  
  
  deserialize(input: any): this {
    this.order = new Order().deserialize(input.order);
    this.item = new Item().deserialize(input.item);
    
    return this;
  };
}