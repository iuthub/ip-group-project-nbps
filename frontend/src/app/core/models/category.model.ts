import { Deserializable } from './deserializable.model';
import { Item } from './item.model';

export class Category implements Deserializable {
  title : string;
  description : string;
  items : Item[];
  
  deserialize(input: any): this {
    return Object.assign(this, input);
  };  
  
  
}