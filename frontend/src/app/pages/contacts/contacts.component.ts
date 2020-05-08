import { Component, OnInit } from '@angular/core';
import { faPhoneAlt, faAt, faLocationArrow } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-contacts',
  templateUrl: './contacts.component.html',
  styleUrls: ['./contacts.component.scss']
})
export class ContactsComponent implements OnInit {
  //Icons
  faAt = faAt;
  faPhoneAlt = faPhoneAlt;
  faLocationArrow = faLocationArrow;
  
  
  constructor() { }

  ngOnInit() {
  }

}
