import { Deserializable } from './deserializable.model';
import { Category } from './category.model';

export class Item implements Deserializable {
  id: string | number;
  title : string;
  description : string;
  price : number;
  category: Category;
  active: boolean;
  main_image: string;
  deserialize(input: any): this {
    Object.assign(this, input);
    this.category = new Category().deserialize(input.category);

    return this;
  };
  
}