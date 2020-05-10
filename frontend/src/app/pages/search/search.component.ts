import { Component, OnInit } from '@angular/core';
import { faSearch } from '@fortawesome/free-solid-svg-icons';
import { ItemService } from 'src/app/core/services/item.service';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { Item } from 'src/app/core/models/item.model';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();

  faSearch = faSearch;
  search: string;

  isLoading = false;
  items: Item[] = [];
  
  constructor(
    private itemService: ItemService,
  ) { }

  ngOnInit(): void {

  }

  onSubmit(e) {
    e.preventDefault();
    
    if (this.search) {
      this.isLoading = true;
      this.items = [];
      this.itemService.search(this.search).pipe(takeUntil(this.destroy)).subscribe(res => {
        this.isLoading = false;
        this.items = res;
      })
    }

  }


  ngOnDestroy() {
    this.destroy.next();
    this.destroy.complete();
  }

}
