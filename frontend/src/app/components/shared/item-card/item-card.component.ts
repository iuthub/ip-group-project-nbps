import { Component, OnInit, Input } from '@angular/core';
import { Item } from 'src/app/core/models/item.model';

@Component({
  selector: 'app-item-card',
  templateUrl: './item-card.component.html',
  styleUrls: ['./item-card.component.scss']
})
export class ItemCardComponent implements OnInit {

  @Input()
  data: Item;
  
  constructor() { }

  ngOnInit(): void {
  }

}
