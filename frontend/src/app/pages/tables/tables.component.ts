import { Component, OnInit, TemplateRef } from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { Table } from 'src/app/core/models/table.model';
import { Subject } from 'rxjs';
import { TableService } from 'src/app/core/services/table.service';
import { takeUntil } from 'rxjs/operators';
import { HttpParams } from '@angular/common/http';
import { BookingService } from 'src/app/core/services/booking.service';
import { ToastrService } from 'ngx-toastr';


@Component({
  selector: 'app-tables',
  templateUrl: './tables.component.html',
  styleUrls: ['./tables.component.scss']
})
export class TablesComponent implements OnInit {
  //Subject needed for unsubscribing of observables in the ngOnDestroy hook
  private destroy = new Subject<void>();
  modalRef: BsModalRef;

  constructor(
    private modalService: BsModalService,
    private tableService: TableService,
    private bookingService: BookingService,
    private toastr: ToastrService
  ) { }

  choosedTable: Number;
  choosedId: Number;
  tables: Table[];
  isLoading = true;
  status;
  time;
  date;
  peopleCount;

  ngOnInit(): void {

    this.tableService.getAllTables().pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.tables = res.tables;
        this.isLoading = false;
      })

  }
  formatDate(date) {
    let d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

    if (month.length < 2)
      month = '0' + month;
    if (day.length < 2)
      day = '0' + day;

    return [year, month, day].join('-');
  }

  formatTime(time) {
    let d = new Date(time),
      hours = '' + (d.getHours()),
      minutes = '' + d.getMinutes(),
      seconds = '' + d.getSeconds();
    if (hours.length < 2)
      hours = '0' + hours;
    if (minutes.length < 2)
      minutes = '0' + minutes;
    if (seconds.length < 2)
      seconds = '0' + seconds;
    return [hours, minutes, seconds].join(':');
  }
  book(id, date, time, peopleCount) {
    let params = new HttpParams();
    params = params.append('book_date', this.formatDate(date));
    params = params.append('book_time', this.formatTime(time));
    this.tableService.getTableStatus(id, params).pipe(takeUntil(this.destroy)).subscribe(
      (res) => {
        this.status = res;
        console.log(this.status);
        if (this.status.free) {
          let data = {
            book_date: this.formatDate(date),
            book_time: this.formatTime(time),
            people_count: peopleCount
          }
          this.bookingService.setBookOfTableById(id, data).pipe(takeUntil(this.destroy)).subscribe(
            (res) => {
              this.toastr.success("Table was booked");
            }
          );
        } else {
          this.toastr.error("Table is busy.");
        }
      });

  }

  openModal(template: TemplateRef<any>, id: Number, number: Number, count) {
    this.choosedTable = number;
    this.choosedId = id;
    this.peopleCount = count;
    this.modalRef = this.modalService.show(template);
  }

}
