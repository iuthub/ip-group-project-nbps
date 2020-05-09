import { Deserializable } from './deserializable.model';
import { Booking } from './booking.model';

export class Table implements Deserializable {
  number: number;
  people_count: number;
  min_deposit: number;
  bookings: Booking[];
  deserialize(input: any): this {
    Object.assign(this, input);
    this.bookings = input.bookings.map(el => new Booking().deserialize(el));
    
    return this;
  };
  
  
}