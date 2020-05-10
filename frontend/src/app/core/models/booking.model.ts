import { Deserializable } from './deserializable.model';
import { User } from './user.model';
import { Table } from './table.model';

export class Booking implements Deserializable {
  user_id: string;
  table_id: string;
  book_date: string;
  book_time: string;
  user: User;
  table: Table;
  created_at: string;
  updated_at: string;

  deserialize(input: any): this {
    Object.assign(this, input);
    this.user = new User().deserialize(input.user);
    this.table = new Table().deserialize(input.table);
    
    
    return this;
  };
  
  
}