import { Deserializable } from './deserializable.model';
import { Booking } from './booking.model';

export class Table implements Deserializable {
  id: number;
  number: number;
  people_count: number;
  min_deposit: number;
  deserialize(input: any): this {
    Object.assign(this, input);

    return this;
  };


}