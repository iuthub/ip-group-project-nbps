import { Component, OnInit } from '@angular/core';
import { Item } from 'src/app/core/models/item.model';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.scss']
})
export class IndexComponent implements OnInit {

  items = [
    {
      id: 0,
      title: "Plov", 
      description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.",
      price: 72000, 
      main_image: "/assets/images/main_image.jpg"
      
    },
    {
      id: 1,
      title: "Plov", 
      description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.",
      price: 72000, 
      main_image: "/assets/images/main_image.jpg"
      
    },
    {
      id: 2,
      title: "Plov", 
      description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.",
      price: 72000, 
      main_image: "/assets/images/main_image.jpg"
      
    },
    {
      id: 3,
      title: "Plov", 
      description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.",
      price: 72000, 
      main_image: "/assets/images/main_image.jpg"
      
    },
  ];
  
  constructor() { }

  ngOnInit() {
  }

}
